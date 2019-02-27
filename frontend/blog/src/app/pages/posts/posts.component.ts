import { Component, OnInit } from '@angular/core';
import { Post } from 'src/app/class/Post';
import { PostService } from 'src/app/services/post.service';

@Component({
  selector: 'app-posts',
  templateUrl: './posts.component.html',
  styleUrls: ['./posts.component.scss']
})
export class PostsComponent implements OnInit {

	private posts: Post[];
  constructor(
		private postService: PostService
	) { }

  ngOnInit() {
		this.loadData();
	}
	
	loadData() {
		this.postService.getPosts().subscribe(
			(data: Post[]) => {
				this.posts = data;
			},
			error => {
				console.log(error);
			}
		);
	}

	deletePost(post: Post) {
		this.postService.deletePost(post.id).subscribe(
			(data: Post) => this.loadData(),
			error => console.log("erro on delete")
		);
	}

}
