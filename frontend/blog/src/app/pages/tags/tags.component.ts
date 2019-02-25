import { Component, OnInit } from '@angular/core';
import { Observable, of } from 'rxjs';
import { TagService } from 'src/app/services/tag.service';
import { Tag } from 'src/app/class/Tag';

@Component({
  selector: 'app-tags',
  templateUrl: './tags.component.html',
  styleUrls: ['./tags.component.scss']
})
export class TagsComponent implements OnInit {

	private tags: Tag[];
	constructor(
		private tagService: TagService
	) { }

	ngOnInit() {
		this.tagService.getTags().subscribe(
				(data: Tag[]) => {
					this.tags = data;
				},
				error => {
					console.log(error);
					//this.handleError(error)
				}
		);
	}

	deleteTag(tag: Tag) {}

  editTag(tag: Tag) {}
	
}
