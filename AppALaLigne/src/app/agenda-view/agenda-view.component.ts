import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { RestService, Day } from '../services/rest.service';


@Component({
  selector: 'app-agenda-view',
  templateUrl: './agenda-view.component.html',
  styleUrls: ['./agenda-view.component.scss']
})
export class AgendaViewComponent implements OnInit {

  days: Day[] = [];
  constructor(public rest: RestService, private router:Router) { }

  ngOnInit(){
    this.getDays();
  }

  getDays(){
    this.rest.getDays().subscribe(
      (response) => {
        console.log(response);
        this.days = response}
    );
  }

}


