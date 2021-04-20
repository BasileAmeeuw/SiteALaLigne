import { RestService, Muscle } from '../services/rest.service';
import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-muscle-detail-view',
  templateUrl: './muscle-detail-view.component.html',
  styleUrls: ['./muscle-detail-view.component.scss']
})
export class MuscleDetailViewComponent implements OnInit {

  muscle:Muscle;
  constructor(public rest: RestService, private route:ActivatedRoute) { }

  ngOnInit(): void {
    const id = this.route.snapshot.params['id'];
    this.getMuscle(id);
  }

  getMuscle(id:string) {
    this.rest.getMuscle(id).subscribe(
      (response) => {
        console.log(response);
        this.muscle= response}
    );
  }

}
