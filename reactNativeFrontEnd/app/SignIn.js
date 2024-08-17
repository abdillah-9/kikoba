import React, { useState } from 'react';
import { StyleSheet, Text, View, TextInput, TouchableOpacity, Alert } from 'react-native';
import { Link, useRouter } from "expo-router";

export default function SignIn() {
  const router = useRouter();
  const [fullName, setFullName] = useState('');
  const [email, setEmail] = useState('');
  const [pword, setPword] = useState('');

  const handleSignUp = () => {
    // Perform validation
    if (!fullName.trim() || !email.trim() || !pword.trim()) {
      Alert.alert('Error', 'Please fill out all fields.');
      return;
    }

    // Simulate API call (replace with actual fetch call)
    fetch('https://6dc7-41-222-179-235.ngrok-free.app/myprojects/jsonKikoba/login.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({ fullName, email, pword }),
    })
      .then(response => response.json())
      .then(data => {
        // Handle response from server
        Alert.alert('Success', data.message);
        
        // Clear form fields after successful signup
        setFullName('');
        setEmail('');
        setPword('');

        //redirect user based on inputs
        if(data.status =="successAdmin"){
          //for admin
          router.push("/viewUsersLoans");
        }
        else if(data.status =="success"){
          //for normal user
          const ids = data.id;
          router.push({pathname:'/chooseService', params:{id:ids}});
        }
        if(data.status =="denied"){
          //for normal user
          router.push("/signUp");
        }
      })
      .catch(error => {
        console.error('Error:', error);
        Alert.alert('Error', 'An error occurred. Please try again.');
      });
  };

  return (
    <View style={styles.container}>
      <Text style={styles.title}>Sign In</Text>
      <TextInput
        style={styles.input}
        placeholder="Full Name"
        value={fullName}
        onChangeText={text => setFullName(text)}
      />
      <TextInput
        style={styles.input}
        placeholder="Email"
        value={email}
        onChangeText={text => setEmail(text)}
        keyboardType="email-address"
        autoCapitalize="none"
      />
      <TextInput
        style={styles.input}
        placeholder="Password"
        value={pword}
        onChangeText={text => setPword(text)}
        secureTextEntry={true}
      />
      <TouchableOpacity style={styles.button} onPress={handleSignUp}>
        <Text style={styles.buttonText}>Sign In</Text>
      </TouchableOpacity>
    </View>
  );
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    justifyContent: 'center',
    alignItems: 'center',
    backgroundColor: '#f0f0f0',
  },
  title: {
    fontSize: 24,
    fontWeight: 'bold',
    marginBottom: 20,
  },
  input: {
    width: '80%',
    height: 40,
    borderColor: '#ccc',
    borderWidth: 1,
    borderRadius: 8,
    marginBottom: 10,
    paddingHorizontal: 10,
  },
  button: {
    backgroundColor: '#4CAF50',
    paddingVertical: 12,
    paddingHorizontal: 60,
    borderRadius: 8,
    marginTop: 20,
  },
  buttonText: {
    color: 'white',
    fontSize: 18,
    textAlign: 'center',
  },
});
