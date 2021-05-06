import { HttpClientModule } from '@angular/common/http';
import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { RouteReuseStrategy } from '@angular/router';

import { IonicModule, IonicRouteStrategy } from '@ionic/angular';

import { AppComponent } from './app.component';
import { AppRoutingModule } from './app-routing.module';
import { FormsModule } from '@angular/forms' ;

import { ActivityComponent } from './activity/activity.component';
import { ActivityAjoutComponent } from './activity-ajout/activity-ajout.component';
import { ActivityDetailComponent } from './activity-detail/activity-detail.component';
import { AgendaComponent } from './agenda/agenda.component';
import { AgendaAjoutComponent } from './agenda-ajout/agenda-ajout.component';
import { MuscleComponent } from './muscle/muscle.component';
import { MuscleAjoutComponent } from './muscle-ajout/muscle-ajout.component';
import { MuscleDetailComponent } from './muscle-detail/muscle-detail.component';

@NgModule({
  declarations: [AppComponent, ActivityComponent, ActivityAjoutComponent,
     ActivityDetailComponent, AgendaComponent, AgendaAjoutComponent, MuscleComponent,
     MuscleAjoutComponent, MuscleDetailComponent ],
  entryComponents: [],
  imports: [FormsModule, BrowserModule, IonicModule.forRoot(), AppRoutingModule, HttpClientModule],
  providers: [{ provide: RouteReuseStrategy, useClass: IonicRouteStrategy }],
  bootstrap: [AppComponent],
})
export class AppModule {}

