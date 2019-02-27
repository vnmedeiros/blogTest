import { BrowserModule } from '@angular/platform-browser';
import { HttpClientModule } from '@angular/common/http';
import { NgModule } from '@angular/core';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { LoginComponent } from './pages/login/login.component';
import { TagsComponent } from './pages/tags/tags.component';
import { AuthorsComponent } from './pages/authors/authors.component';
import { PostsComponent } from './pages/posts/posts.component';
import { TagSingleComponent } from './pages/tag-single/tag-single.component';
import { AuthorSingleComponent } from './pages/author-single/author-single.component';
import { PostSingleComponent } from './pages/post-single/post-single.component';

@NgModule({
  declarations: [
    AppComponent,
    LoginComponent,
    TagsComponent,
    AuthorsComponent,
    PostsComponent,
    TagSingleComponent,
    AuthorSingleComponent,
    PostSingleComponent
  ],
  imports: [
		BrowserModule,
		HttpClientModule,
		FormsModule,
		ReactiveFormsModule,
    AppRoutingModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
