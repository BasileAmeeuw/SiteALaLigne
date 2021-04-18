import { AuthService } from './../services/auth.services';
import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';

@Component({
  selector: 'app-auth',
  templateUrl: './auth.component.html',
  styleUrls: ['./auth.component.scss']
})
export class AuthComponent implements OnInit {

  authStatus: boolean;

  constructor(private AuthService: AuthService, private router:Router) { }

  ngOnInit(): void {
    this.authStatus = this.AuthService.isAuth;
  }
  onSignIn(){
    this.AuthService.signIn().then(
      () => {
        console.log('Connexion réussie');
        this.authStatus = this.AuthService.isAuth;
        this.router.navigate(['activity']);
      }
    )
  }
  onSignOut(){
    this.AuthService.signOut();
    this.authStatus = this.AuthService.isAuth;
  }
}
