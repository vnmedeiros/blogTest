import { Component, OnInit } from '@angular/core';
import { TagService } from 'src/app/services/tag.service';
import { ActivatedRoute } from '@angular/router';
import { Tag } from 'src/app/class/Tag';

@Component({
  selector: 'app-tag-single',
  templateUrl: './tag-single.component.html',
  styleUrls: ['./tag-single.component.scss']
})
export class TagSingleComponent implements OnInit {

	public tag: Tag = new Tag();

	constructor(
		private tagService: TagService,
		private route: ActivatedRoute
	) { }

	ngOnInit() {
		this.route.params.subscribe(params => {
			let id = params['id'];
			this.tagService.getTag(id).subscribe(
				(data: Tag) => this.tag = data,
				error => console.log(error)
			);
		});
	}

}
