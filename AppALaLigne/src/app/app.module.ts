import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';

import {RestService } from './services/rest.service'
import { LOCALE_ID } from '@angular/core'
import { AppComponent } from './app.component';
import { ActivityViewComponent } from './activity-view/activity-view.component';
import { MuscleViewComponent } from './muscle-view/muscle-view.component';
import { AgendaViewComponent } from './agenda-view/agenda-view.component';
import { RouterModule, Routes } from '@angular/router';
import { HttpClientModule } from '@angular/common/http';
import { ActivityDetailViewComponent } from './activity-detail-view/activity-detail-view.component';
import { MuscleDetailViewComponent } from './muscle-detail-view/muscle-detail-view.component'
import localeFr from '@angular/common/locales/fr';
import { registerLocaleData } from '@angular/common';
registerLocaleData(localeFr, 'fr');

const appRoutes: Routes = [
  { path: 'activity', component: ActivityViewComponent },
  { path: '', component: ActivityViewComponent },
  { path: 'muscle', component: MuscleViewComponent },
  { path: 'agenda', component: AgendaViewComponent },
  { path: 'activityDetail/:id', component: ActivityDetailViewComponent },
  { path: 'muscleDetail/:id', component: MuscleDetailViewComponent },
];

@NgModule({
  declarations: [
    AppComponent,
    ActivityViewComponent,
    MuscleViewComponent,
    AgendaViewComponent,
    ActivityDetailViewComponent,
    MuscleDetailViewComponent
  ],
  imports: [
    BrowserModule,
    HttpClientModule,
    RouterModule.forRoot(appRoutes)

  ],
  providers: [RestService,
              {provide: LOCALE_ID, useValue: 'fr-FR' },],
  bootstrap: [AppComponent]
})
export class AppModule { }
