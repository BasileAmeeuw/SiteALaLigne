import { ComponentFixture, TestBed } from '@angular/core/testing';

import { MuscleAjoutComponent } from './muscle-ajout.component';

describe('MuscleAjoutComponent', () => {
  let component: MuscleAjoutComponent;
  let fixture: ComponentFixture<MuscleAjoutComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ MuscleAjoutComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(MuscleAjoutComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
