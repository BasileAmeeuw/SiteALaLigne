import { RestService, Activity } from '../services/rest.service';
import { Component, OnInit, Input } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';

@Component({
  selector: 'app-activity-detail',
  templateUrl: './activity-detail.component.html',
  styleUrls: ['./activity-detail.component.scss']
})

export class ActivityDetailComponent implements OnInit {


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
  constructor(public rest: RestService, private router:Router, private route:ActivatedRoute) { }

  ngOnInit(): void {
    const id = this.route.snapshot.params['id'];
    console.log(id)
    this.getActivity(id)
  }

  back(){
    this.router.navigateByUrl('/activity');
  }

  getActivity(id:string) {
    this.rest.getActivity(id).subscribe(
      (response) => {
        console.log(response);
        this.activity = response}
    );
  }

  deleteActivity(){
    const id = this.route.snapshot.params['id'];
    this.rest.deleteActivity(String(id)).subscribe(
      (response) => {
        console.log(response.status)
        if (response.status == 200){
          this.router.navigateByUrl('/activity');
        } else {
          console.log("probleme avec le delete");
        }
      }
    );
  }

  editActivity(){
    const id = this.route.snapshot.params['id'];
    this.router.navigateByUrl('/activityEdit/' + id);
  }

}
