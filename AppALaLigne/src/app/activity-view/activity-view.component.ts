import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { RestService, Activity } from '../services/rest.service';

@Component({
  selector: 'app-activity-view',
  templateUrl: './activity-view.component.html',
  styleUrls: ['./activity-view.component.scss']
})
export class ActivityViewComponent implements OnInit {


  activities: Activity[] = [];

  constructor(public rest: RestService, private router:Router) {}

  ngOnInit(){
    this.getActivities();
  }

  getActivities(){
    this.rest.getActivities().subscribe(
      (response) => {
        console.log(response);
        this.activities = response}
    );
  }

  detailActivity( id:string){
    this.router.navigateByUrl('/activityDetail/' + id);
  }

  addActivity() {

  }

  editActivity(id:string){

  }

  deleteActivity(id:string){
    this.rest.deleteActivity(id).subscribe(
      (response) => {
        console.log(response)
      }
    );
  }


}
