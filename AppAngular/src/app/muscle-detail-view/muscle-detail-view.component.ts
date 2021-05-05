import { RestService, Muscle } from '../services/rest.service';
import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';

@Component({
  selector: 'app-muscle-detail-view',
  templateUrl: './muscle-detail-view.component.html',
  styleUrls: ['./muscle-detail-view.component.scss']
})
export class MuscleDetailViewComponent implements OnInit {

  muscle:Muscle;
  constructor(public rest: RestService, private router:Router, private route:ActivatedRoute) { }

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

  editMuscle(id:number) {
    this.router.navigateByUrl('/muscleEdit/' + id);
  }

  deleteMuscle(id:number){
    this.rest.deleteMuscle(String(id)).subscribe(
      (response) => {
        console.log(response.status)
        if (response.status == 200){
          this.router.navigateByUrl('/muscle');
        } else {
          console.log("probleme avec le delete dans muscle");
        }
      }
    );
  }

}
