import { Component, OnInit } from '@angular/core';
import { Post } from 'src/app/class/Post';
import { FormGroup, FormControl, Validators } from '@angular/forms';
import { PostService } from 'src/app/services/post.service';
import { ActivatedRoute } from '@angular/router';
import { Author } from 'src/app/class/Author';
import { AuthorService } from 'src/app/services/author.service';

@Component({
  selector: 'app-post-single',
  templateUrl: './post-single.component.html',
  styleUrls: ['./post-single.component.scss']
})
export class PostSingleComponent implements OnInit {

	public post: Post = new Post();
	public authorList: Author[];
	
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
		private route: ActivatedRoute
	) { }

	ngOnInit() {
		this.authorService.getAuthors().subscribe(
			(data:Author[]) => {this.authorList = data;}
		);
		
		this.createForm();
		this.fetchPost();
	}

	fetchPost() {
		this.route.params.subscribe(params => {
			let id = params['id'];
			if(id) {
				this.postService.getPost(id).subscribe(
					(data: Post) => this.post = data,
					error => console.log(error)
				);
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
			published: this.published
		});
	}

	onSubmit() {
		if (this.postForm.valid) {
			this.postService.insetOrUpdate(this.post).subscribe(
				(data: Post) => {
					this.post = data;
				},
				error => console.log(error)
			);
		}
	}

}
