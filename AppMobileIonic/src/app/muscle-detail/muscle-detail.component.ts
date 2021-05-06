import { RestService, Muscle } from '../services/rest.service';
import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';

@Component({
  selector: 'app-muscle-detail',
  templateUrl: './muscle-detail.component.html',
  styleUrls: ['./muscle-detail.component.scss']
})
export class MuscleDetailComponent implements OnInit {

  muscle:Muscle = {
    id:0,
    nameOfMuscle:"",
    ExtraExpl:"",
    image:""
  }
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

  editMuscle() {
    const id = this.route.snapshot.params['id'];
    this.router.navigateByUrl('/muscleEdit/' + id);
  }

  deleteMuscle(){
    const id = this.route.snapshot.params['id'];
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

  back(){
    this.router.navigateByUrl('/muscle');
  }

}
