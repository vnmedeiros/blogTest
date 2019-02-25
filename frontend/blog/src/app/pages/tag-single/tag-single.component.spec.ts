import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { TagSingleComponent } from './tag-single.component';

describe('TagSingleComponent', () => {
  let component: TagSingleComponent;
  let fixture: ComponentFixture<TagSingleComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ TagSingleComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(TagSingleComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
