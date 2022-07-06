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
  form: FormGroup;
  constructor(public fb: FormBuilder, private http: HttpClient) {
    this.form = this.fb.group({
      email: [''],
    });
  }
  ngOnInit() {}
  submitForm() {
    var formData: any = new FormData();
    formData.append('email', this.form.get('email')?.value);
    this.http
      .post('http://localhost:8000/api/subscribe', formData)
      .subscribe({
        next: (response) => console.log(response),
        error: (error) => console.log(error),
      });
  }
}
