import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable, of } from 'rxjs';
import {Author} from '../class/Author'
import { environment } from '../../environments/environment';

@Injectable({
  providedIn: 'root'
})
export class AuthorService {

	private URL = `${environment.API_URL}/authors`;

	constructor(private http: HttpClient) {}
	
	getAuthors(): Observable<Author[]> {
		return this.http.get<Author[]>(this.URL);
	}

	getAuthor(id: number): Observable<Author> {
		return this.http.get<Author>(`${this.URL}/${id}`);
	}

	insertAuthor(Author: Author): Observable<Author> {
		return this.http.post<Author>(`${this.URL}`, Author);
	}

	updateAuthor(Author: Author): Observable<Author> {
		return this.http.put<Author>(`${this.URL}/${Author.id}`, Author);
	}

	deleteAuthor(id: number): Observable<Author> {
		return this.http.delete<Author>(`${this.URL}/${id}`);
	}

	insetOrUpdate(Author: Author): Observable<Author> {
		if(Author.id) {
			return this.updateAuthor(Author);
		} else {
			return this.insertAuthor(Author);
		}
	}
}
