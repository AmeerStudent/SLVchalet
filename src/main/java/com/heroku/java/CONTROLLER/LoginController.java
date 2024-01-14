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

import com.heroku.java.MODEL.*;

import jakarta.servlet.http.HttpSession;

import java.sql.*;
import javax.sql.DataSource;
import java.util.ArrayList;
import java.util.Map;

import java.util.List;

@Controller
public class LoginController {
    private final DataSource dataSource;

    @Autowired
    public LoginController(DataSource dataSource) {
        this.dataSource = dataSource;
    }

    @PostMapping("/admin")
    public String admin(@RequestParam(name = "success", required = false) Boolean success, String adminId, String staffPass, HttpSession session, Model model, staff staff) {

        try {
            // String returnPage = null;
            Connection connection = dataSource.getConnection();

            String sql = "SELECT adminId ,staffPass FROM public.staff WHERE adminId=?";
            final var statement = connection.prepareStatement(sql);
            statement.setString(1, adminId);

            final var resultSet = statement.executeQuery();

            System.out.println("ID: " + adminId);
            System.out.println("password : " + staffPass);

            if (resultSet.next()) {

                String staffId = resultSet.getString("staffId");
                String staffName = resultSet.getString("staffName");
                String staffEmail = resultSet.getString("staffEmail");
                String staffPass = resultSet.getString("staffPass");
                String staffPhoneNo = resultSet.getString("staffPhoneNo");
                String adminId = resultSet.getString("adminId");

                System.out.println(adminId);
                // if they're admin
                System.out.println("Id : " + adminId.equals(adminId) + " | " + adminId);
                System.out.println("Password status : " + staffPass.equals(staffPass));

                if (adminId.equals(adminId) && staffPass.equals(staffPass)) {

                    session.setAttribute("adminId", adminId);
                    session.setAttribute("staffPass", staffPass);
                    
                    return "redirect:/index?success=true";
                }
                connection.close();
            return "redirect:/admin?invalidUsername&Password";
            }

            

        } catch (SQLException sqe) {
            System.out.println("Error Code = " + sqe.getErrorCode());
            System.out.println("SQL state = " + sqe.getSQLState());
            System.out.println("Message = " + sqe.getMessage());
            System.out.println("printTrace /n");
            sqe.printStackTrace();

            return "redirect:/admin?error";

        } catch (Exception e) {
            System.out.println("E message : " + e.getMessage());
            return "redirect:/admin?error";
        }

    }

    @PostMapping("/loginstaff")
    public String loginstaff(@RequestParam(name = "success", required = false) Boolean success, HttpSession session, Model model, String staffId, String staffPass, Model Model, staff staff) {

        try {
            // String returnPage = null;
            Connection connection = dataSource.getConnection();

            String sql = "SELECT staffId, staffName, staffEmail, staffPass, staffPhoneNo, adminId FROM public.staff WHERE staffId=?";
            final var statement = connection.prepareStatement(sql);
            statement.setString(1, staffId);

            final var resultSet = statement.executeQuery();

            System.out.println("staff pass : " + staffPass);
            System.out.println("staff : " + staffId);

            if (resultSet.next()) {

            	String staffId = resultSet.getString("staffId");
                String staffName = resultSet.getString("staffName");
                String staffEmail = resultSet.getString("staffEmail");
                String staffPass = resultSet.getString("staffPass");
                String staffPhoneNo = resultSet.getString("staffPhoneNo");
                String adminId = resultSet.getString("adminId");

                System.out.println(staffName);
                // if they're admin
                System.out.println("Id : " + staffId.equals(staffId) + " | " + staffId);
                System.out.println("Password status : " + staffPass.equals(staffPass));

                if (staffId.equals(staffId)
                        && staffPass.equals(staffPass)) {

                    session.setAttribute("staffName", staffname);
                    session.setAttribute("staffId", staffid);

                    if (staffName.equals("Admin")) {
                        session.setAttribute("staffName", "Admin");
                        connection.close();
                        
                        // debug
                        System.out.println("manager name : " + staffName);
                        System.out.println("manager id: " + adminId);
                        return "redirect:/admindashboard?success=true";

                    } 

                        // debug
                        System.out.println("staff name : " + staffName);
                        System.out.println("staff id: " + staffId);
                        return "redirect:/staffdashboard?success=true";
                    }

                }

                connection.close();
            return "redirect:/index?invalidUsername&Password";
            } catch (SQLException sqe) {
            System.out.println("Error Code = " + sqe.getErrorCode());
            System.out.println("SQL state = " + sqe.getSQLState());
            System.out.println("Message = " + sqe.getMessage());
            System.out.println("printTrace /n");
            sqe.printStackTrace();

            return "redirect:/index?error"; } 
        } catch (Exception e) {
            System.out.println("E message : " + e.getMessage());
            return "redirect:/index?error";
        }
    @GetMapping("/logout")
    public String logout(HttpSession session) {
        session.invalidate();
        return "redirect:/";
    }
    }

    
