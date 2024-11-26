package main

import (
	"fmt"
	"golang.org/x/crypto/bcrypt"
	"net/http"
	"regexp"
)

func formHandler(w http.ResponseWriter, r *http.Request) {
	if r.Method == http.MethodPost {
		// Parse the form data
		err := r.ParseForm()
		if err != nil {
			http.Error(w, "Failed to parse form", http.StatusBadRequest)
			return
		}

		// Access form values
		email := r.FormValue("email")
		password, errPasswd := hashPassword(r.FormValue("password"))

		if errPasswd != nil {
			http.Error(w, "Error password hash", http.StatusBadRequest)
			return
		}

		name := r.FormValue("name")
		surname := r.FormValue("surname")

		if isValidEmail(email) {
			// Respond with the received data
			fmt.Fprintf(w, "Email: %s\nName: %s\nSurname: %s\nHash password: %s\n", email, name, surname, password)

		} else {
			http.Error(w, "Email is incorrect", http.StatusBadRequest)
			return
		}

	} else {
		// Serve the HTML form when the request method is GET
		fmt.Fprint(w, `<html> 
						<form method="POST">
							Email: <input type="text" name="email"><br>
							Hasło: <input type="password" name="password"><br>
							Imię: <input type="text" name="name"><br>
							Nazwisko: <input type="text" name="surname"><br>
							<input type="submit" value="Submit">
                      		</form>
						</html>`)

	}
}

func main() {
	http.HandleFunc("/submit", formHandler)
	fmt.Println("Server is running on http://localhost:8080/submit")
	http.ListenAndServe(":8080", nil)
}

func isValidEmail(email string) bool {
	// Regular expression for validating an Email
	// Note: This regex may not cover all edge cases but works for common cases.
	re := regexp.MustCompile(`^[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,4}$`)
	return re.MatchString(email)
}

func hashPassword(password string) (string, error) {
	bytes, err := bcrypt.GenerateFromPassword([]byte(password), 14)
	return string(bytes), err
}
