import { RestService, Activity } from '../services/rest.service';
import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-activity-detail-view',
  templateUrl: './activity-detail-view.component.html',
  styleUrls: ['./activity-detail-view.component.scss']
})
export class ActivityDetailViewComponent implements OnInit {

  activity:Activity;
  constructor(public rest: RestService, private route:ActivatedRoute) { }

  ngOnInit(): void {
    const id = this.route.snapshot.params['id'];
    this.getActivity(id);
  }

  getActivity(id:string) {
    this.rest.getActivity(id).subscribe(
      (response) => {
        console.log(response);
        this.activity = response}
    );
  }

}
