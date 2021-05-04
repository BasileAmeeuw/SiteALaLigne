import { ComponentFixture, TestBed } from '@angular/core/testing';

import { AgendaAjoutComponent } from './agenda-ajout.component';

describe('AgendaAjoutComponent', () => {
  let component: AgendaAjoutComponent;
  let fixture: ComponentFixture<AgendaAjoutComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ AgendaAjoutComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(AgendaAjoutComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
