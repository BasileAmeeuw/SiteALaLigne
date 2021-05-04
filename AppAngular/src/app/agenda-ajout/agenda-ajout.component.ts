import { RestService, Day } from '../services/rest.service';
import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';

@Component({
  selector: 'app-agenda-ajout',
  templateUrl: './agenda-ajout.component.html',
  styleUrls: ['./agenda-ajout.component.scss']
})
export class AgendaAjoutComponent implements OnInit {

  date: Date = new Date(2018, 0O5, 0O5, 17, 23, 42, 11); 
  day:Day = {
    "date":this.date
  }
  constructor(public rest: RestService, private route:ActivatedRoute, private router:Router) { 

  }

  ngOnInit(): void {

  }

  detailActivity( id:string){
    this.router.navigateByUrl('/agenda');
  }

  addDay() {
    this.rest.addDay( this.day).subscribe(
      (response) => {
        console.log(response);
        if (response.id != null) {
          this.detailActivity(response.id);
        }
      }
    )
  }
}

