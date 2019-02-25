import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { LoginComponent } from './pages/login/login.component';
import { TagsComponent } from './pages/tags/tags.component';
import { AuthorsComponent } from './pages/authors/authors.component';
import { PostsComponent } from './pages/posts/posts.component';
import { TagSingleComponent } from './pages/tag-single/tag-single.component';

const routes: Routes = [
	{ path: 'login', component: LoginComponent},
	{ path: 'tags', component: TagsComponent},
	{ path: 'tags/:id', component: TagSingleComponent },
	{ path: 'authors', component: AuthorsComponent},
	{ path: 'posts', component: PostsComponent},
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
