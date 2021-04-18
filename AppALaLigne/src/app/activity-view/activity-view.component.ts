import { HttpClient, HttpHeaders, HttpParams } from '@angular/common/http';
import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import 'rxjs/add/operator/map';

@Component({
  selector: 'app-activity-view',
  templateUrl: './activity-view.component.html',
  styleUrls: ['./activity-view.component.scss']
})
export class ActivityViewComponent implements OnInit {


  activities: Object;
  JsonActivity:string;
  activity:Object;

  constructor(private http: HttpClient, private router:Router) {}

  ngOnInit(){
    this.activities = this.http.get( "http://127.0.0.1:8000/api/activity");
    console.log(this.activities);
  }

  getActi( id:number){
    this.router.navigateByUrl('/activityDetail/' + id);
  }


}
