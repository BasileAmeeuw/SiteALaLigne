import { Component } from '@angular/core';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss']
})
export class AppComponent {
  title = 'AppALaLigne';
  isAuth = false;
  activiteOne="uihuihui";
  activiteTwo="uihutrhyrthhui";
  activiteThree="trhyrtihui";

  constructor() {
    setTimeout(
      ()=>{
        this.isAuth=true;
      }, 4000
    );
  }
  onChangerMuscle() {
    console.log('Okok');
  }
}



