import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { AuthorSingleComponent } from './author-single.component';

describe('AuthorSingleComponent', () => {
  let component: AuthorSingleComponent;
  let fixture: ComponentFixture<AuthorSingleComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ AuthorSingleComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(AuthorSingleComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
