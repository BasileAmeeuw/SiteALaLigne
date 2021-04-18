import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ActivityDetailViewComponent } from './activity-detail-view.component';

describe('ActivityDetailViewComponent', () => {
  let component: ActivityDetailViewComponent;
  let fixture: ComponentFixture<ActivityDetailViewComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ ActivityDetailViewComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(ActivityDetailViewComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
