import { RestService, Activity } from '../services/rest.service';
import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';

@Component({
  selector: 'app-activity-ajout',
  templateUrl: './activity-ajout.component.html',
  styleUrls: ['./activity-ajout.component.scss']
})
export class ActivityAjoutComponent implements OnInit {

  activity: Activity;
  constructor(public rest: RestService, private route:ActivatedRoute, private router:Router) { 

  }

  ngOnInit(): void {
  }

  addActivity() {
    console.log(this.activity)
    this.rest.addActivity( this.activity).subscribe(
      (response) => {
        console.log(response);
        this.router.navigate(['/activity']);
      }
    )
  }
}
