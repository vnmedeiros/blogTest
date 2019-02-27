import { Component, OnInit } from '@angular/core';
import { TagService } from 'src/app/services/tag.service';
import { ActivatedRoute } from '@angular/router';
import { Tag } from 'src/app/class/Tag';
import { FormGroup, FormControl, Validators } from '@angular/forms';

@Component({
  selector: 'app-tag-single',
  templateUrl: './tag-single.component.html',
  styleUrls: ['./tag-single.component.scss']
})
export class TagSingleComponent implements OnInit {

	public tag: Tag = new Tag();
	
	tagForm: FormGroup;
	id: FormControl;
	name: FormControl;

	constructor(
		private tagService: TagService,
		private route: ActivatedRoute
	) { }

	ngOnInit() {
		this.createForm();
		this.fetchTag();
	}

	fetchTag() {
		this.route.params.subscribe(params => {
			let id = params['id'];
			if(id) {
				this.tagService.getTag(id).subscribe(
					(data: Tag) => this.tag = data,
					error => console.log(error)
				);
			}
		});
	}

	createForm() {
    this.name = new FormControl('', [
      Validators.required,
      Validators.minLength(5),
      Validators.maxLength(255)
    ]);
		this.id = new FormControl('', []);

		this.tagForm = new FormGroup({
			name: this.name,
			id: this.id
		});
	}

	onSubmit() {
		if (this.tagForm.valid) {
			this.tagService.insetOrUpdate(this.tag).subscribe(
				(data: Tag) => {
					this.tag = data;
				},
				error => console.log(error)
			);
		}
	}

}
