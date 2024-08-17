import React, { useState } from 'react';
import { StyleSheet, Text, View, TextInput, TouchableOpacity, Alert } from 'react-native';
import { Link, useRouter } from "expo-router";

export default function SignIn() {
  const router = useRouter();
  const [fullName, setFullName] = useState('');
  const [email, setEmail] = useState('');
  const [pword, setPword] = useState('');
  const [fname, setFname] = useState('');
  const [mname, setMname] = useState('');
  const [sname, setSname] = useState('');
  const [age, setAge] = useState('');
  const [phone, setPhone] = useState('');

  const handleSignUp = () => {
    // Perform validation
    if (!fullName.trim() || !email.trim() || !pword.trim() || !fname.trim() || !mname.trim() || !sname.trim() || !age.trim() || !phone.trim()) {
      Alert.alert('Error', 'Please fill out all fields.');
      return;
    }

    // Simulate API call (replace with actual fetch call)
    fetch('https://6dc7-41-222-179-235.ngrok-free.app/myprojects/jsonKikoba/signup.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({ fullName, email, pword, fname, mname, sname, age, phone }),
    })
      .then(response => response.json())
      .then(data => {
        // ***** Handle response from server ************
        // Clear form fields after successful signup
        setFullName('');
        setEmail('');
        setPword('');
        setFname('');
        setMname('');
        setSname('');
        setAge('');
        setPhone('');

        //redirect user based on inputs
        if(data.status =="success"){
          //when account not existing
          Alert.alert('Success', data.message);
          router.push("/SignIn");
        }
        if(data.status =="denied"){
          //when account already exists
          Alert.alert('Error', data.message);
        }
      })
      .catch(error => {
        console.error('Error:', error);
        Alert.alert('Error', 'An error occurred. Please try again.');
      });
  };

  return (
    <View style={styles.container}>
      <Text style={styles.title}>Create account</Text>
      <TextInput
        style={styles.input}
        placeholder="Username"
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
            <TextInput
        style={styles.input}
        placeholder="First name"
        value={fname}
        onChangeText={text => setFname(text)}
      />
      <TextInput
        style={styles.input}
        placeholder="Middle name"
        value={mname}
        onChangeText={text => setMname(text)}
      />
      <TextInput
        style={styles.input}
        placeholder="Sir name"
        value={sname}
        onChangeText={text => setSname(text)}
      />
      <TextInput
        style={styles.input}
        placeholder="Phone number"
        keyboardType="numeric"
        value={phone}
        onChangeText={text => setPhone(text)}
      />
      <TextInput
        style={styles.input}
        placeholder="Age"
        keyboardType="numeric"
        value={age}
        onChangeText={text => setAge(text)}
      />
      <TouchableOpacity style={styles.button} onPress={handleSignUp}>
        <Text style={styles.buttonText}>Sign Up</Text>
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
