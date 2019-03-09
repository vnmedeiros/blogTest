import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { LoginComponent } from './pages/login/login.component';
import { TagsComponent } from './pages/tags/tags.component';
import { AuthorsComponent } from './pages/authors/authors.component';
import { PostsComponent } from './pages/posts/posts.component';
import { TagSingleComponent } from './pages/tag-single/tag-single.component';
import { AuthorSingleComponent } from './pages/author-single/author-single.component';
import { PostSingleComponent } from './pages/post-single/post-single.component';
import { HomeComponent } from './pages/home/home.component';
import { ViewComponent } from './pages/view/view.component';

const routes: Routes = [
	{ path: 'login', component: LoginComponent},
	
	{ path: 'tags', component: TagsComponent},
	{ path: 'tag/:id', component: TagSingleComponent },
	{ path: 'tag', component: TagSingleComponent},

	{ path: 'authors', component: AuthorsComponent},
	{ path: 'author/:id', component: AuthorSingleComponent},
	{ path: 'author', component: AuthorSingleComponent},
	
	{ path: 'posts', component: PostsComponent},
	{ path: 'post/:id', component: PostSingleComponent},
	{ path: 'post', component: PostSingleComponent},

	{ path: 'post/view/:id', component: ViewComponent},
	{ path: '', component: HomeComponent},
	{ path: 'home', component: HomeComponent}
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
