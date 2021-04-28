import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ActivityAjoutComponent } from './activity-ajout.component';

describe('ActivityAjoutComponent', () => {
  let component: ActivityAjoutComponent;
  let fixture: ComponentFixture<ActivityAjoutComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ ActivityAjoutComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(ActivityAjoutComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
