package com.heroku.java;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.boot.SpringApplication;
import org.springframework.boot.autoconfigure.SpringBootApplication;
import org.springframework.context.annotation.Bean;
import org.springframework.security.crypto.bcrypt.BCryptPasswordEncoder;
import org.springframework.stereotype.Controller;
// import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.GetMapping;
// import org.springframework.web.bind.annotation.ModelAttribute;
// import org.springframework.web.bind.annotation.PostMapping;

// import com.fasterxml.jackson.annotation.JacksonInject.Value;

import jakarta.servlet.http.HttpSession;

import javax.sql.DataSource;
// import java.sql.Connection;
//import java.sql.SQLException;
// import java.util.ArrayList;
// import java.util.Map;

// import org.jscience.physics.amount.Amount;
// import org.jscience.physics.model.RelativisticModel;
// import javax.measure.unit.SI;

@SpringBootApplication
@Controller
public class GettingStartedApplication {
    private final DataSource dataSource;

    @Autowired
    public GettingStartedApplication(DataSource dataSource) {
        this.dataSource = dataSource;
    }

    @GetMapping("/")
    public String home(HttpSession session) {
        return "index";
    }

    @GetMapping("/about")
    public String about() {
        return "user/about";
    }
    @GetMapping("/staffdashboard")
    public String staffdashboard() {
        return "staffdashboard";

    }
   
    @GetMapping("/admindashboard")
    public String admindashboard() {
        return "admindashboard";

    }
   @GetMapping("/productadmin")
    public String productadmin() {
        return "productadmin";

    }
    
    @GetMapping("/postads")
    public String postads() {
        return "postads";

    }

    

    
    @GetMapping("/login")
    public String login() {
        return "login";

    }
     

     @GetMapping("/admin")
    public String admin() {
        return "admin";

    }
     @GetMapping("/loginstaff")
    public String loginstaff() {
        return "loginstaff";

    }
    
    

    @GetMapping("/product")
    public String product() {
        return "product";
    }
    

    @GetMapping("/customerregister")
    public String custregister() {
        return "user/customerregister";
    }
     


    @Bean
    public BCryptPasswordEncoder bCryptPasswordEncoder() {
        return new BCryptPasswordEncoder();
    }

    public static void main(String[] args) {
        SpringApplication.run(GettingStartedApplication.class, args);
    }
}
