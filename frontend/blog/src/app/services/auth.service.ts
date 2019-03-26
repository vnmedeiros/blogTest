import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { map } from 'rxjs/operators';
import * as moment from "moment";
import { environment } from '../../environments/environment';

@Injectable({
	providedIn: 'root'
})
export class AuthService {

	constructor(private http: HttpClient) { }

	private URL = `${environment.API_URL}/auth`;

	login(email:string, password:string ) {
		return this.http.post<any>(`${this.URL}/login`, {"email":email, "password":password})
			.pipe(map(authResult => {
				if (authResult) {
					this.setSession(authResult)
				}
				return authResult;
			}));
	}

	private setSession(authResult) {
		const expiresAt = moment().add(authResult.expiresIn,'second');
		localStorage.setItem('current_user', JSON.stringify(authResult.user));
		localStorage.setItem('token', authResult.token);
		localStorage.setItem("expires_at", JSON.stringify(expiresAt.valueOf()) );
	}

	logout() {
		localStorage.removeItem("token");
		localStorage.removeItem("expires_at");
		localStorage.removeItem("current_user");
	}

	public getToken(): string {
		return localStorage.getItem('token');
	}

	getExpiration() {
		const expiration = localStorage.getItem("expires_at");
		const expiresAt = JSON.parse(expiration);
		return moment(expiresAt);
	}

	// public isLoggedIn(): boolean {
  //   // get the token
  //   const token = this.getToken();
  //   // return a boolean reflecting 
  //   // whether or not the token is expired
  //   return tokenNotExpired(null, token);
  // }

	public isLoggedIn() {
		return moment().isBefore(this.getExpiration());
	}

	isLoggedOut() {
		return !this.isLoggedIn();
	}
}
