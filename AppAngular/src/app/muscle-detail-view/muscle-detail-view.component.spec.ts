import { ComponentFixture, TestBed } from '@angular/core/testing';

import { MuscleDetailViewComponent } from './muscle-detail-view.component';

describe('MuscleDetailViewComponent', () => {
  let component: MuscleDetailViewComponent;
  let fixture: ComponentFixture<MuscleDetailViewComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ MuscleDetailViewComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(MuscleDetailViewComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
