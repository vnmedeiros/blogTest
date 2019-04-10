import { Component, OnInit } from '@angular/core';
import { FormGroup, FormBuilder, Validators } from '@angular/forms';
import {Md5} from 'ts-md5/dist/md5';
import { Router } from '@angular/router';
import { AuthService } from 'src/app/services/auth.service';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss']
})
export class LoginComponent implements OnInit {
	form:FormGroup;

	ngOnInit() {
	}
	
	constructor(
		private fb: FormBuilder,
		private authService: AuthService,
		private router: Router) {

		this.form = this.fb.group({
			email: ['', Validators.required],
			password: ['', Validators.required]
		});
	}

	login() {
		const val = this.form.value;

		if (val.email && val.password) {
			let hashPass = Md5.hashStr(val.password);
			this.authService.login(val.email, hashPass)
				.subscribe(
					() => {
						console.log("User is logged in");
						this.router.navigateByUrl('/home');
					}
				);
		}
	}

}
