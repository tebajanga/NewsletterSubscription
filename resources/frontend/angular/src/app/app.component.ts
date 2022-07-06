import { Component } from '@angular/core';
import { FormBuilder, FormGroup } from '@angular/forms';
import { HttpClient } from '@angular/common/http';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {
  title = 'angular';
  successMessage = '';
  errorMessage =  '';
  showSuccessMessage = false;
  showErrorMessage = false;
  form: FormGroup;
  constructor(public fb: FormBuilder, private http: HttpClient) {
    this.form = this.fb.group({
      email: [''],
    });
    this.errorMessage = '';
    this.successMessage = '';
  }
  ngOnInit() {}
  submitForm() {
    this.clearForm()
    var formData: any = new FormData();
    formData.append('email', this.form.get('email')?.value);
    this.http
      .post('http://localhost:8000/api/subscribe', formData)
      .subscribe({
        next: (response) => {
          this.successMessage = response.toString();
          this.showSuccessMessage = true;
        },
        error: (error) => {
          this.errorMessage = error.error.message
          this.showErrorMessage = true;
        },
      });
  }
  unsubscribe() {
    this.clearForm()
    var formData: any = new FormData();
    formData.append('email', this.form.get('email')?.value);
    this.http
      .post('http://localhost:8000/api/unsubscribe', formData)
      .subscribe({
        next: (response) => {
          this.successMessage = response.toString();
          this.showSuccessMessage = true;
        },
        error: (error) => {
          this.errorMessage = error.error.toString();
          this.showErrorMessage = true;
        },
      });
  }
  clearForm() {
    this.showSuccessMessage = false;
    this.showErrorMessage = false;
    this.errorMessage = '';
  }
}
