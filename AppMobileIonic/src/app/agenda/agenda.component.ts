import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { RestService, Day } from '../services/rest.service';


@Component({
  selector: 'app-agenda',
  templateUrl: './agenda.component.html',
  styleUrls: ['./agenda.component.scss']
})
export class AgendaComponent implements OnInit {

  days: Day[] = [];
  day:Day = {
    id:0,
    date: new Date()
  }
  id:number;
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

  addDay() {
    this.router.navigateByUrl('/agendaAjout');
  }

  detailDay(day:Day){
    this.day=day;
    if (this.id==day.id) {
      this.id=null;
    } else {
      this.id=day.id;
    }
  }

  detailActivity( id:string){
    this.router.navigateByUrl('/activityDetail/' + id);
  }

  deleteDay(id:string) {
    this.rest.deleteDay(id).subscribe(
      (response) => {
        console.log(response.status)
        if (response.status == 200){
          this.getDays();
        } else {
          console.log("probleme avec le delete");
        }
      }
    );
  }

}
