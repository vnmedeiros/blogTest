import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable, of } from 'rxjs';
import {Post} from '../class/Post'
import { environment } from '../../environments/environment';

@Injectable({
  providedIn: 'root'
})
export class PostService {

	private URL = `${environment.API_URL}/posts`;

	constructor(private http: HttpClient) {}

	getPosts(): Observable<Post[]> {
		return this.http.get<Post[]>(this.URL);
	}

	getPostsByTag(tagId: number): Observable<Post[]> {
		return this.http.get<Post[]>(`${this.URL}/tag/${tagId}`);
	}

	getPost(id: number): Observable<Post> {
		return this.http.get<Post>(`${this.URL}/${id}`);
	}

	insertPosts(post: Post): Observable<Post> {
		return this.http.post<Post>(`${this.URL}`, post);
	}

	updatePosts(post: Post): Observable<Post> {
		return this.http.put<Post>(`${this.URL}/${post.id}`, post);
	}

	deletePost(id: number): Observable<Post> {
		return this.http.delete<Post>(`${this.URL}/${id}`);
	}

	insetOrUpdate(post: Post): Observable<Post> {
		if(post.id) {
			return this.updatePosts(post);
		} else {
			return this.insertPosts(post);
		}
	}
}
