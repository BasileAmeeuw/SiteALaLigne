import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { RestService, Muscle } from '../services/rest.service';


@Component({
  selector: 'app-muscle-view',
  templateUrl: './muscle-view.component.html',
  styleUrls: ['./muscle-view.component.scss']
})
export class MuscleViewComponent implements OnInit {

  muscles: Muscle[] = [];
  constructor(public rest: RestService, private router:Router) { }


  ngOnInit(){
    this.getMuscles();
  }

  getMuscles(){
    this.rest.getMuscles().subscribe(
      (response) => {
        console.log(response);
        this.muscles = response}
    );
  }

  detailMuscle( id:number){
    this.router.navigateByUrl('/muscleDetail/' + id);
  }
}

