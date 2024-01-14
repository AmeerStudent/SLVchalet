package com.heroku.java.CONTROLLER;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.boot.SpringApplication;
import org.springframework.boot.autoconfigure.SpringBootApplication;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.ModelAttribute;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.RequestParam;

import com.heroku.java.model.staff;

import jakarta.servlet.http.HttpSession;

import java.sql.*;
import javax.sql.DataSource;
import java.util.ArrayList;
import java.util.Map;

import java.util.List;

@Controller
public class StaffController {
    private final DataSource dataSource;
    @Autowired
    public StaffController(DataSource dataSource) {
        this.dataSource = dataSource;
    }

    // @GetMapping("/managerStaffList")
    // public String managerStaffList(Model model) {
    //     List<staff> staffs = new ArrayList<staff>();
    // } hold dulu-
@GetMapping("/signupadmin")
    public String signupadmin() {
        return "signupadmin";
    }
    // admin add staff
     @PostMapping("/signupadmin")
    public String signupadmin(@ModelAttribute("signupadmin")staff staff){

        try {
            Connection connection = dataSource.getConnection();
            String sql = "INSERT INTO public.staff(staffId,staffName,staffEmail,staffPhoneNo,staffPass,adminId) VALUES(?,?,?,?,?,?)";
            final var statement = connection.prepareStatement(sql);

            String staffId = staff.getStaffId();
            String staffName = staff.getStaffName();
            String staffEmail = staff.getStaffEmail();
            String staffPhoneNo = staff.getStaffPhoneNo();
            String staffPass = staff.getStaffPass();
            String adminId = staff.getAdminId();
            
            statement.setString(1, staffId);
            statement.setString(2, staffName);
            statement.setString(3, staffEmail);
            statement.setString(4, staffPhoneNo);         
            statement.setString(5, staffPass);
            statement.setString(6, adminId);

            statement.executeUpdate();
            
             System.out.println("Staff ID Number : "+staffId);
            
            connection.close();
                
                } catch (Exception e) {
                    e.printStackTrace();
                    return "redirect:/index";
                }
            return "redirect:/admindashboard";
        }
}

