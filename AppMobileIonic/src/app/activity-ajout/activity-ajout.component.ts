import { RestService, Activity, Muscle } from '../services/rest.service';
import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';

@Component({
  selector: 'app-activity-ajout',
  templateUrl: './activity-ajout.component.html',
  styleUrls: ['./activity-ajout.component.scss'],
})
export class ActivityAjoutComponent implements OnInit {

  muscles: Muscle[] = [];

  activity:Activity = {
    "title":'',
    "description":"",
    "image":"",
    "duration":0,
    "difficult":0,
    "author":"",
    "material":"",
    "muscle":{
      "nameOfMuscle":"",
      "id":0
    }
  }

  constructor(public rest: RestService, private route:ActivatedRoute, private router:Router) { 

  }

  ngOnInit(): void {
    this.getMuscles();
    const id = this.route.snapshot.params['id'];
    if (id!=null){
      this.getActivity(id)
      console.log("Edit")
    } else {
      console.log("Add")
    }
  }

  getActivity(id:string) {
    this.rest.getActivity(id).subscribe(
      (response) => {
        console.log(response);
        this.activity = response}
    );
  }

  detailActivity( id:string){
    this.router.navigateByUrl('/activityDetail/' + id);
  }

  back(){
    this.router.navigateByUrl('/activity');
  }

  addActivity() {
    const id = this.route.snapshot.params['id'];
    console.log(this.activity);
    if (this.activity.muscle.nameOfMuscle==""){
      this.activity.muscle=null
    }
    if (id==null){
      this.rest.addActivity(this.activity).subscribe(
        (response) => {
          console.log(response);
          if (response.id != null) {
            this.detailActivity(response.id);
          }
        }
    )}else {
      this.rest.editActivity(this.activity, id).subscribe(
        (response) => {
          console.log(response);
          if (response.id != null) {
            this.detailActivity(response.id);
          }
        }
    )
    }
  }


  getMuscles(){
    this.rest.getMuscles().subscribe(
      (response) => {
        console.log(response);
        this.muscles = response}
    );
  }

  
}
