import { NgModule } from '@angular/core';
import { PreloadAllModules, RouterModule, Routes } from '@angular/router';
import { ActivityAjoutComponent } from './activity-ajout/activity-ajout.component';
import { ActivityDetailComponent } from './activity-detail/activity-detail.component';
import { ActivityComponent } from './activity/activity.component';
import { AgendaAjoutComponent } from './agenda-ajout/agenda-ajout.component';
import { AgendaComponent } from './agenda/agenda.component';
import { MuscleAjoutComponent } from './muscle-ajout/muscle-ajout.component';
import { MuscleDetailComponent } from './muscle-detail/muscle-detail.component';
import { MuscleComponent } from './muscle/muscle.component';

const routes: Routes = [
  {
    path: 'home',
    loadChildren: () => import('./home/home.module').then( m => m.HomePageModule)
  },
  {
    path: '',
    redirectTo: 'activity',
    pathMatch: 'full'
  },
  {
    path: 'activity',
    component: ActivityComponent
  },
  {
    path: 'activityAjout',
    component: ActivityAjoutComponent
  },
  {
    path: 'activityEdit/:id',
    component: ActivityAjoutComponent
  },
  {
    path: 'activityDetail/:id',
    component: ActivityDetailComponent
  },
  {
    path: 'agenda',
    component: AgendaComponent
  },
  {
    path: 'agendaAjout',
    component: AgendaAjoutComponent
  },
  {
    path: 'muscle',
    component: MuscleComponent
  },
  {
    path: 'muscleAjout',
    component: MuscleAjoutComponent
  },
  {
    path: 'muscleEdit/:id',
    component: MuscleAjoutComponent
  },
  {
    path: 'muscleDetail/:id',
    component: MuscleDetailComponent
  },

];

@NgModule({
  imports: [
    RouterModule.forRoot(routes, { preloadingStrategy: PreloadAllModules })
  ],
  exports: [RouterModule]
})
export class AppRoutingModule {}

