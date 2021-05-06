import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { RestService, Activity } from '../services/rest.service';

@Component({
  selector: 'app-activity',
  templateUrl: './activity.component.html',
  styleUrls: ['./activity.component.scss']
})
export class ActivityComponent implements OnInit {


  activities: Activity[] = [];
  activity: Activity = {
    id:0,
    title:"",
    description:"",
    image:"",
    duration:0,
    difficult:0,
    author:"",
    material:"",
    createdAt:"",
    modifiedAt:"",
    muscle:{
      nameOfMuscle:""
    },
    days:[]
  };;
  id:number;

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

  detailActivity( activity:Activity){
    this.getActivities();
    this.activity=activity;
    if (this.id==activity.id) {
      this.id=null;
    } else {
      this.id=activity.id;
    }
  }

  show(id:string){
    this.router.navigateByUrl('/activityDetail/'+id);
  }

  addActivity() {
    this.router.navigateByUrl('/activityAjout');
  }

  editActivity(id:string){
    this.router.navigateByUrl('/activityEdit/' + id);
  }

  deleteActivity(id:string){
    this.rest.deleteActivity(id).subscribe(
      (response) => {
        console.log(response.status)
        if (response.status == 200){
          this.getActivities();
        } else {
          console.log("probleme avec le delete");
        }
      }
    );
  }

  getShort(str:string){
    if (str.length>75){
      str=str.slice(0,75)+"..."
    } 
    return str;
  }


}
