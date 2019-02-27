import { Component, OnInit } from '@angular/core';
import { Author } from 'src/app/class/Author';
import { FormGroup, FormControl, Validators } from '@angular/forms';
import { AuthorService } from 'src/app/services/author.service';
import { ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-author-single',
  templateUrl: './author-single.component.html',
  styleUrls: ['./author-single.component.scss']
})
export class AuthorSingleComponent implements OnInit {

  public author: Author = new Author();
	
	authorForm: FormGroup;
	id: FormControl;
	name: FormControl;

	constructor(
		private authorService: AuthorService,
		private route: ActivatedRoute
	) { }

	ngOnInit() {
		this.createForm();
		this.fetchAuthor();
	}

	fetchAuthor() {
		this.route.params.subscribe(params => {
			let id = params['id'];
			if(id) {
				this.authorService.getAuthor(id).subscribe(
					(data: Author) => this.author = data,
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

		this.authorForm = new FormGroup({
			name: this.name,
			id: this.id
		});
	}

	onSubmit() {
		if (this.authorForm.valid) {
			this.authorService.insetOrUpdate(this.author).subscribe(
				(data: Author) => {
					this.author = data;
				},
				error => console.log(error)
			);
		}
	}

}
