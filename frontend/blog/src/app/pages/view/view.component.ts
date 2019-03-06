import { Component, OnInit } from '@angular/core';
import { PostService } from 'src/app/services/post.service';
import { ActivatedRoute } from '@angular/router';
import { Post } from 'src/app/class/Post';

@Component({
  selector: 'app-view',
  templateUrl: './view.component.html',
  styleUrls: ['./view.component.scss']
})
export class ViewComponent implements OnInit {

	public post: Post = new Post();

	constructor(
		private route: ActivatedRoute,
		private postService: PostService,
	) { }

	ngOnInit() {
		this.fetchPost();
	}

	fetchPost() {
		this.route.params.subscribe(params => {
			let id = params['id'];
			if(id) {
				this.postService.getPost(id).subscribe(
					(data: Post) => {
						this.post = data;
					},
					error => {
						console.log(error);
					}
				);
			} else {
				
			}
		});
	}

}
