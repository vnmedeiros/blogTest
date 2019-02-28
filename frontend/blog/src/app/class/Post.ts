import { Author } from "./Author";
import { Tag } from "./Tag";

export class Post
{
	public id: number;
	public title: String;
	public slug: String;
	public body: String;
	public image: String;
	public published: boolean;
	public author: Author;
	public tags: Tag[];
}
