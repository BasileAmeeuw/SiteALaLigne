import { HttpClient} from '@angular/common/http';
import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { Observable } from 'rxjs';


@Component({
  selector: 'app-activity-detail-view',
  templateUrl: './activity-detail-view.component.html',
  styleUrls: ['./activity-detail-view.component.scss']
})
export class ActivityDetailViewComponent implements OnInit {

  activity:Object;
  constructor(private route: ActivatedRoute, private http:HttpClient) { }

  ngOnInit(): void {
    
    const id = this.route.snapshot.params['id'];
    this.activity=this.http.get("http://127.0.0.1:8000/api/activity/" + id)
    this.http.get("http://127.0.0.1:8000/api/activity/" + id).subscribe(data => 
    {this.activity=data; console.log(data);
      })
    // this.http.get<Object>("http://127.0.0.1:8000/api/activity/" + id).subscribe((obj)=>{this.activity=obj});
    // console.log( this.http.get<Object>("http://127.0.0.1:8000/api/activity/" + id).map((obj)=>{this.activity=obj}))
    console.log(this.activity)


  }

}
