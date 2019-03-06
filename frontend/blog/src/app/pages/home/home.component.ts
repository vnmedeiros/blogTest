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

	private posts: Post[];
	private tags: Tag[];

	constructor(
		private postService: PostService,
		private tagService: TagService
	) { }

  ngOnInit() {
		this.postService.getPosts().subscribe(
			(data: Post[]) => {
				this.posts = data;
			},
			error => {
				console.log(error);
			}
		);
		this.tagService.getTags().subscribe((data:Tag[]) => this.tags = data);
  }

}
