import { Component, OnInit } from '@angular/core';
import { Post } from 'src/app/class/Post';
import { FormGroup, FormControl, Validators, FormArray } from '@angular/forms';
import { PostService } from 'src/app/services/post.service';
import { ActivatedRoute } from '@angular/router';
import { Author } from 'src/app/class/Author';
import { Tag } from 'src/app/class/Tag';
import { AuthorService } from 'src/app/services/author.service';
import { TagService } from 'src/app/services/tag.service';

@Component({
  selector: 'app-post-single',
  templateUrl: './post-single.component.html',
  styleUrls: ['./post-single.component.scss']
})
export class PostSingleComponent implements OnInit {

	public post: Post = new Post();
	public authorList: Author[];
	public tagList: Tag[];

	postForm: FormGroup;
	id: FormControl;
	body: FormControl;
	title: FormControl;
	image: FormControl;
	author: FormControl;
	published: FormControl;

	constructor(
		private postService: PostService,
		private authorService: AuthorService,
		private tagService: TagService,
		private route: ActivatedRoute
	) { }

	ngOnInit() {
		this.createForm();
		this.fetchPost();
		
		this.authorService.getAuthors().subscribe(
			(data:Author[]) => {this.authorList = data;}
		);
	}
	
	fetchTags() {
		this.tagService.getTags().subscribe(
			(data:Tag[]) => {
				this.tagList = data;
				this.tagList.map((obj, id) => {
					let selected = false;
					for (let tag of this.post.tags) {
						if (obj.id == tag.id) {
							selected = true;
							break;
						}
					}
					const control = new FormControl(selected); // if first item set to true, else false
					(this.postForm.controls.tags as FormArray).push(control);
				});
			}
		);
	}

	fetchPost() {
		this.route.params.subscribe(params => {
			let id = params['id'];
			if(id) {
				this.postService.getPost(id).subscribe(
					(data: Post) => {
						this.post = data;
						this.fetchTags();
					},
					error => {
						console.log(error);
					}
				);
			} else {
				this.fetchTags();
			}
		});
	}

	createForm() {
		this.id = new FormControl('', []);
		this.body = new FormControl('', [
			Validators.required
		]);
		this.title = new FormControl('', [
			Validators.required,
			Validators.minLength(5),
			Validators.maxLength(255)
		]);
		this.image = new FormControl('', [
			Validators.required
		]);
		this.published = new FormControl('', [
			Validators.required
		]);
		this.author = new FormControl('', [
			Validators.required
		]);
		this.postForm = new FormGroup({
			id: this.id,
			body: this.body,
			title: this.title,
			image: this.image,
			author: this.author,
			published: this.published,
			tags: new FormArray([])
		});
	}

	onSubmit() {
		if (this.postForm.valid) {
			let tags = [];
			for (let i=0; i< this.postForm.value.tags.length; i++) {
				if (this.postForm.value.tags[i] == true )
					tags.push(this.tagList[i]);
			}
			this.post.tags = tags;
			this.postService.insetOrUpdate(this.post).subscribe(
				(data: Post) => {
					this.post = data;
				},
				error => console.log(error)
			);
		}
	}

}
