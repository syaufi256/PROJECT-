/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package Tugas;

import java.util.Scanner;


/**
 *
 * @author user
 */
public class Tugas1 {
     public static void main(String[] args) {
        Scanner input = new Scanner(System.in).useDelimiter("\n");
        System.out.print("Masukkan nilai ujian pertama: ");
        double nilai1 = input.nextDouble();

        System.out.print("Masukkan nilai ujian kedua: ");
        double nilai2 = input.nextDouble();

        System.out.print("Masukkan nilai ujian ketiga: ");
        double nilai3 = input.nextDouble();

        double rataRata = (nilai1 + nilai2 + nilai3) / 3;

        if (rataRata >= 80) {
            System.out.printf("Rata-rata nilai: %.2f - Lulus%n", rataRata);
        } else {
            System.out.printf("Rata-rata nilai: %.2f - Belum Lulus%n", rataRata);
        }
     }
}
