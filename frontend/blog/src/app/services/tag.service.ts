import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable, of } from 'rxjs';
import {Tag} from '../class/Tag'
import { environment } from '../../environments/environment';

@Injectable({
	providedIn: 'root'
})
export class TagService {

	private URL = `${environment.API_URL}/tags`;

	constructor(private http: HttpClient) {}

	getTags(): Observable<Tag[]> {
		return this.http.get<Tag[]>(this.URL);
	}

	getTag(id: number): Observable<Tag> {
		return this.http.get<Tag>(`${this.URL}/${id}`);
	}

	updateTag(tag: Tag): Observable<Tag> {
		return this.http.put<Tag>(`${this.URL}/${tag.id}`, tag);
	}

	deleteTag(id: number): Observable<Tag> {
		return this.http.delete<Tag>(`${this.URL}/${id}`);
	}

}
