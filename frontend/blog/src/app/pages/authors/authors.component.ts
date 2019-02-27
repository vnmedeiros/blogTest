import { Component, OnInit } from '@angular/core';
import { Author } from 'src/app/class/Author';
import { AuthorService } from 'src/app/services/author.service';

@Component({
  selector: 'app-authors',
  templateUrl: './authors.component.html',
  styleUrls: ['./authors.component.scss']
})
export class AuthorsComponent implements OnInit {

  private authors: Author[];
	constructor(
		private authorService: AuthorService
	) { }

	ngOnInit() {
		this.loadData();
	}

	loadData() {
		this.authorService.getAuthors().subscribe(
			(data: Author[]) => {
				this.authors = data;
			},
			error => {
				console.log(error);
			}
		);
	}

	deleteAuthor(author: Author) {
		this.authorService.deleteAuthor(author.id).subscribe(
			(data: Author) => this.loadData(),
			error => console.log("erro on delete")
		);
	}

}
