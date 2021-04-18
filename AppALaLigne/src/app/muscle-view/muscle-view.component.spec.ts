import { ComponentFixture, TestBed } from '@angular/core/testing';

import { MuscleViewComponent } from './muscle-view.component';

describe('MuscleViewComponent', () => {
  let component: MuscleViewComponent;
  let fixture: ComponentFixture<MuscleViewComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ MuscleViewComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(MuscleViewComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
