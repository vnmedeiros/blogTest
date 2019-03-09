import { Component, OnInit } from '@angular/core';
import { PostService } from 'src/app/services/post.service';
import { Post } from 'src/app/class/Post';
import { TagService } from 'src/app/services/tag.service';
import { Tag } from 'src/app/class/Tag';

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.scss']
})
export class HomeComponent implements OnInit {

	public isLoading: boolean = true;
	private posts: Post[];
	private tags: Tag[];

	constructor(
		private postService: PostService,
		private tagService: TagService
	) { }

	ngOnInit() {
		this.isLoading = true;
		this.postService.getPosts().subscribe(
			(data: Post[]) => {
				this.posts = data;
				this.isLoading = false;
			},
			error => {
				console.log(error);
			}
		);
		this.tagService.getTags().subscribe((data:Tag[]) => this.tags = data);
	}

	onChangeTag(tagId) {
		this.isLoading = true;
		if (tagId == - 1 )
			return this.ngOnInit();
		this.postService.getPostsByTag(tagId).subscribe(
			(data: Post[]) => {
				this.posts = data;
				this.isLoading = false;
			},
			error => {console.log(error);}
		);
	}

}
