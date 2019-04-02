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
import { AuthGuardService as AuthGuard } from '../app/guard/auth-guard.service'

const routes: Routes = [
	{ path: 'login', component: LoginComponent},
	
	{ path: 'tags', component: TagsComponent, canActivate: [AuthGuard] },
	{ path: 'tag/:id', component: TagSingleComponent, canActivate: [AuthGuard] },
	{ path: 'tag', component: TagSingleComponent, canActivate: [AuthGuard]},

	{ path: 'authors', component: AuthorsComponent, canActivate: [AuthGuard]},
	{ path: 'author/:id', component: AuthorSingleComponent, canActivate: [AuthGuard]},
	{ path: 'author', component: AuthorSingleComponent, canActivate: [AuthGuard]},
	
	{ path: 'posts', component: PostsComponent, canActivate: [AuthGuard]},
	{ path: 'post/:id', component: PostSingleComponent, canActivate: [AuthGuard]},
	{ path: 'post', component: PostSingleComponent, canActivate: [AuthGuard]},

	{ path: 'post/view/:id', component: ViewComponent},
	{ path: '', component: HomeComponent},
	{ path: 'home', component: HomeComponent}
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
